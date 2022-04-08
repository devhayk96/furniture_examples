<?php

namespace App\Policies;

use App\Enums\Permissions\RepairingTypePermissions;
use App\Models\RepairingType;
use Illuminate\Auth\Access\HandlesAuthorization;

class RepairingTypePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the repairing-type can view the repairing-type.
     *
     * @param RepairingType|null $repairing_type
     * @return mixed
     */
    public function view(?RepairingType $repairing_type)
    {
        return $repairing_type->hasPermissionTo(RepairingTypePermissions::VIEW);
    }

    /**
     * Determine whether the repairing-type can create repairing-types.
     *
     * @param RepairingType $repairing_type
     * @return mixed
     */
    public function create(RepairingType $repairing_type)
    {
        if ($repairing_type->can(RepairingTypePermissions::CREATE)) {
            return true;
        }
    }

    /**
     * Determine whether the repairing-type can update the repairing-type.
     *
     * @param RepairingType $repairing_type
     * @return mixed
     */
    public function update(RepairingType $repairing_type)
    {
        if ($repairing_type->can(RepairingTypePermissions::UPDATE)) {
            return true;
        }
    }

    /**
     * Determine whether the repairing-type can delete the repairing-type.
     *
     * @param RepairingType $repairing_type
     * @return mixed
     */
    public function delete(RepairingType $repairing_type)
    {
        if ($repairing_type->can(RepairingTypePermissions::DELETE)) {
            return true;
        }
    }

    /**
     * Determine whether the repairing-type can restore the repairing-type.
     *
     * @param RepairingType $repairing_type
     * @return mixed
     */
    public function restore(RepairingType $repairing_type)
    {
        //
    }

    /**
     * Determine whether the repairing-type can permanently delete the repairing-type.
     *
     * @param RepairingType $repairing_type
     * @return mixed
     */
    public function forceDelete(RepairingType $repairing_type)
    {
        //
    }
}
