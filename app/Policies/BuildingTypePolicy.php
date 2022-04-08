<?php

namespace App\Policies;

use App\Enums\Permissions\BuildingTypePermissions;
use App\Models\BuildingType;
use Illuminate\Auth\Access\HandlesAuthorization;

class BuildingTypePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the building-type can view the building-type.
     *
     * @param BuildingType|null $building_type
     * @return mixed
     */
    public function view(?BuildingType $building_type)
    {
        return $building_type->hasPermissionTo(BuildingTypePermissions::VIEW);
    }

    /**
     * Determine whether the building-type can create building-types.
     *
     * @param BuildingType $building_type
     * @return mixed
     */
    public function create(BuildingType $building_type)
    {
        if ($building_type->can(BuildingTypePermissions::CREATE)) {
            return true;
        }
    }

    /**
     * Determine whether the building-type can update the building-type.
     *
     * @param BuildingType $building_type
     * @return mixed
     */
    public function update(BuildingType $building_type)
    {
        if ($building_type->can(BuildingTypePermissions::UPDATE)) {
            return true;
        }
    }

    /**
     * Determine whether the building-type can delete the building-type.
     *
     * @param BuildingType $building_type
     * @return mixed
     */
    public function delete(BuildingType $building_type)
    {
        if ($building_type->can(BuildingTypePermissions::DELETE)) {
            return true;
        }
    }

    /**
     * Determine whether the building-type can restore the building-type.
     *
     * @param BuildingType $building_type
     * @return mixed
     */
    public function restore(BuildingType $building_type)
    {
        //
    }

    /**
     * Determine whether the building-type can permanently delete the building-type.
     *
     * @param BuildingType $building_type
     * @return mixed
     */
    public function forceDelete(BuildingType $building_type)
    {
        //
    }
}
