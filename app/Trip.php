<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Trip extends Model
{

    protected $fillable
        = [
            'guest_id',
            'trip_type_id',
            'order_date',
            'price',
            'people_num',
            'status',
        ];

    protected $attributes
        = [
            'service_id' => 6,
        ];

    public function tripType()
    {
        return $this->belongsTo(TripType::class);
    }

    public function guest()
    {
        return $this->belongsTo(Guest::class);
    }

    /**
     * @return \___PHPSTORM_HELPERS\static|array|mixed
     */
    public static function getAllTripOrders()
    {
        $trips = self::all();
        if (count($trips) > 0) {
            $serviceName = Services::getServiceName($trips[0]->service_id);
            foreach ($trips as $key => $trip) {
                $trip->serviceName = $serviceName;
                $trip->roomNumber = ($trip->guest->rooms[0]->number) ? $trip->guest->rooms[0]->number
                    : 'TripErr id:' . $trip->id;
            }
        } else {
            $trips = [];
        }

        return $trips;
    }

    public static function getOrderHistoryByGuest($guestId)
    {
        $trips = self::where('guest_id', $guestId)->get();
        if (count($trips) > 0) {
            $serviceName = Services::getServiceName($trips[0]->service_id);
            foreach ($trips as $key => $trip) {
                $trip->tripTypeName = $trip->tripType->name;
                $trip->serviceName = $serviceName;
                $trip->roomNumber = ($trip->guest->rooms[0]->number) ? $trip->guest->rooms[0]->number
                    : 'TripErr id:' . $trip->id;
            }
        } else {
            $trips = [];
        }

        return $trips;
    }

    public static function getNumPeopleOnTheList($id) {
        $events =  self::where('trip_type_id', $id)->sum('people_num');

        return $events;
    }
}
