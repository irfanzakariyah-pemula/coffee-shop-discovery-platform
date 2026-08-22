<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserController extends Controller
{
    /**
     * Display a listing of users.
     */
    public function index(Request $request): View
    {
        $query = User::query();

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        // Filter by role
        if ($request->filled('role')) {
            $query->where('role', $request->role);
        }

        $users = $query->withCount(['reviews', 'favorites'])
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('admin.users.index', compact('users'));
    }

    /**
     * Show user details.
     */
    public function show(User $user): View
    {
        $user->load(['reviews.coffeeShop', 'favorites.coffeeShop']);
        
        $stats = [
            'total_reviews' => $user->reviews()->count(),
            'total_favorites' => $user->favorites()->count(),
            'avg_rating_given' => round($user->reviews()->avg('rating'), 2),
        ];

        return view('admin.users.show', compact('user', 'stats'));
    }

    /**
     * Delete user.
     */
    public function destroy(User $user): RedirectResponse
    {
        // Prevent deleting admin users
        if ($user->isAdmin()) {
            return back()->with('error', 'Tidak dapat menghapus user admin.');
        }

        // Prevent deleting self
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Tidak dapat menghapus akun sendiri.');
        }

        $user->delete();

        return redirect()
            ->route('admin.users.index')
            ->with('success', 'User berhasil dihapus.');
    }

    /**
     * Toggle user role (admin/user).
     */
    public function toggleRole(User $user): RedirectResponse
    {
        // Prevent changing own role
        if ($user->id === auth()->id()) {
            return back()->with('error', 'Tidak dapat mengubah role sendiri.');
        }

        $user->role = $user->role === 'admin' ? 'user' : 'admin';
        $user->save();

        return back()->with('success', "Role berhasil diubah menjadi {$user->role}.");
    }
}
