<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Password;
use Illuminate\Http\Request;

class ForgotPasswordControllers extends Controller
{
    public function sendResetLinkEmail(Request $request)
    {
        // Validation de l'email
        $request->validate(['email' => 'required|email|exists:users,email']);

        try {
            // Envoi du lien de réinitialisation du mot de passe
            $response = Password::sendResetLink($request->only('email'));

            // Vérification de la réponse et retour JSON
            if ($response === Password::RESET_LINK_SENT) {
                return response()->json(['status' => 'success', 'message' => 'Email sent successfully!']);
            } else {
                return response()->json(['status' => 'error', 'message' => trans($response)]);
            }
        } catch (\Exception $e) {
            // Log de l'erreur pour le débogage
            Log::error('Failed to send reset link email: '.$e->getMessage());

            return response()->json(['status' => 'error', 'message' => 'An error occurred. Please try again later.'], 500);
        }
    }

    public function showResetForm(Request $request, $token = null)
    {
        return view('auth.reset')->with(['token' => $token, 'email' => $request->email]);
    }

    public function reset(Request $request)
    {
        $request->validate([
        'token' => 'required',
        'email' => 'required|email|exists:users,email',
        'password' => 'required|confirmed|min:8',
    ]);

        $response = Password::reset($request->only('email', 'password', 'password_confirmation', 'token'), function ($user, $password) {
            $user->password = bcrypt($password);
            $user->save();
        });

        return $response === Password::PASSWORD_RESET
        ? redirect()->route('login')->with('status', 'Password has been reset!')
        : back()->withErrors(['email' => 'Failed to reset password.']);
    }
}
