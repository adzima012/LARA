<?php

namespace App\Policies;

use App\Models\LARA;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

/**
 * Policy untuk model LARA (Surat Digital)
 * 
 * Class ini mengatur otorisasi untuk akses ke surat digital:
 * - Siapa yang bisa melihat surat
 * - Siapa yang bisa membuat surat baru
 * - Siapa yang bisa mengubah surat
 * - Siapa yang bisa menghapus surat
 */
class LARAPolicy
{
    use HandlesAuthorization;

    /**
     * Mengecek apakah user dapat melihat daftar surat
     * 
     * @param User $user User yang sedang login
     * @return bool Selalu true karena semua user bisa melihat daftar surat mereka
     */
    public function viewAny(User $user): bool
    {
        return true;
    }

    /**
     * Mengecek apakah user dapat melihat detail surat tertentu
     * 
     * @param User $user User yang sedang login
     * @param LARA $lara Surat yang ingin dilihat
     * @return bool True jika user adalah pemilik atau penerima surat yang sudah dirilis
     */
    public function view(User $user, LARA $lara): bool
    {
        // User bisa melihat surat jika:
        // 1. Dia adalah pemilik surat, atau
        // 2. Dia adalah penerima surat DAN surat sudah dirilis
        return $user->id === $lara->pemilik_id || 
               ($user->email === $lara->recipient_email && $lara->is_released);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return true;
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, LARA $lara): bool
    {
        return $user->id === $lara->pemilik_id && !$lara->is_released;
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, LARA $lara): bool
    {
        return $user->id === $lara->pemilik_id && !$lara->is_released;
    }
}
