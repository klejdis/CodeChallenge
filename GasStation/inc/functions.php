<?php
/**
 * This function returns the smallest index of gas station
 * which allows me to travel the whole route starting at that station
 *
 * @param $gasStations
 * @return integer|string
 */
function GasStation($input){

    //remove the first element from array to get all the gas stations
    $gasStations = array_slice($input,1);

    //this array will hold the indexes of station which allowes to travel the whole route
    $indexes = [];

    foreach ($gasStations as $index => $gasStation){

        $startGasStationIndex = $index;
        $traveled = true;

        $gallons = explode(':', $gasStation)[0];
        $cost = explode(':', $gasStation)[1];

        //if gallons less than cost its imposible to get to the next one
        if ($gallons < $cost){
            continue;
        }

        //substract the cost from gallons i have at current station
        $gallons = $gallons - $cost;

        //if i am at the last element of array return 0 to begin iteration of array from begining
        $i = ( ($startGasStationIndex + 1) >= count($gasStations) ) ? 0 : $startGasStationIndex + 1;

        //loop the whole gas stations to see if i can complete the whole route from this starting point
        while ($i != $startGasStationIndex){
            //calculate the gallons i take at this gas station
            $gallons += explode(':',$gasStations[$i])[0];

            //if the amount of gallons i have cannot send me to the next one
            //brake the loop
            if ($gallons < explode(':',$gasStations[$i])[1]){
                $traveled = false;
                break;
            }

            //i can go to the next station so substract the cost
            $gallons = $gallons - explode(':', $gasStations[$i])[1];

            //increase index to go to the next station
            $i++;
        }

        //if i travelled the whole route from this starting point add this gas stations indexes to the array
        if ($traveled){
            $indexes[] = $startGasStationIndex;
        }

    }

    //if none of stations allowd to travel the whole route return impossible
    if (count($indexes) == 0){
        return 'impossible';
    }

    //return the minimum of indexes to return the first station which allowes
    return min($indexes);
}