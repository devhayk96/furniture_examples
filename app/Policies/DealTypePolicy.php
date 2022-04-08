<?php

namespace App\Policies;

use App\Enums\Permissions\DealTypePermissions;
use App\Models\DealType;
use Illuminate\Auth\Access\HandlesAuthorization;

class DealTypePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the deal-type can view the deal-type.
     *
     * @param DealType|null $deal_type
     * @return mixed
     */
    public function view(?DealType $deal_type)
    {
        return $deal_type->hasPermissionTo(DealTypePermissions::VIEW);
    }

    /**
     * Determine whether the deal-type can create deal-types.
     *
     * @param DealType $deal_type
     * @return mixed
     */
    public function create(DealType $deal_type)
    {
        if ($deal_type->can(DealTypePermissions::CREATE)) {
            return true;
        }
    }

    /**
     * Determine whether the deal-type can update the deal-type.
     *
     * @param DealType $deal_type
     * @return mixed
     */
    public function update(DealType $deal_type)
    {
        if ($deal_type->can(DealTypePermissions::UPDATE)) {
            return true;
        }
    }

    /**
     * Determine whether the deal-type can delete the deal-type.
     *
     * @param DealType $deal_type
     * @return mixed
     */
    public function delete(DealType $deal_type)
    {
        if ($deal_type->can(DealTypePermissions::DELETE)) {
            return true;
        }
    }

    /**
     * Determine whether the deal-type can restore the deal-type.
     *
     * @param DealType $deal_type
     * @return mixed
     */
    public function restore(DealType $deal_type)
    {
        //
    }

    /**
     * Determine whether the deal-type can permanently delete the deal-type.
     *
     * @param DealType $deal_type
     * @return mixed
     */
    public function forceDelete(DealType $deal_type)
    {
        //
    }
}
