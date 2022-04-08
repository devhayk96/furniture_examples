<?php

namespace App\Policies;

use App\Enums\Permissions\BuildingFloorPermissions;
use App\Models\BuildingFloor;
use Illuminate\Auth\Access\HandlesAuthorization;

class BuildingFloorPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the building-type can view the building-type.
     *
     * @param BuildingFloor|null $building_floor
     * @return mixed
     */
    public function view(?BuildingFloor $building_floor)
    {
        return $building_floor->hasPermissionTo(BuildingFloorPermissions::VIEW);
    }

    /**
     * Determine whether the building-type can create building-types.
     *
     * @param BuildingFloor $building_floor
     * @return mixed
     */
    public function create(BuildingFloor $building_floor)
    {
        if ($building_floor->can(BuildingFloorPermissions::CREATE)) {
            return true;
        }
    }

    /**
     * Determine whether the building-type can update the building-type.
     *
     * @param BuildingFloor $building_floor
     * @return mixed
     */
    public function update(BuildingFloor $building_floor)
    {
        if ($building_floor->can(BuildingFloorPermissions::UPDATE)) {
            return true;
        }
    }

    /**
     * Determine whether the building-type can delete the building-type.
     *
     * @param BuildingFloor $building_floor
     * @return mixed
     */
    public function delete(BuildingFloor $building_floor)
    {
        if ($building_floor->can(BuildingFloorPermissions::DELETE)) {
            return true;
        }
    }

    /**
     * Determine whether the building-type can restore the building-type.
     *
     * @param BuildingFloor $building_floor
     * @return mixed
     */
    public function restore(BuildingFloor $building_floor)
    {
        //
    }

    /**
     * Determine whether the building-type can permanently delete the building-type.
     *
     * @param BuildingFloor $building_floor
     * @return mixed
     */
    public function forceDelete(BuildingFloor $building_floor)
    {
        //
    }
}
