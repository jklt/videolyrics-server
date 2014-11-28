<?php

/**
 * @SWG\Model(id="Rate"),
 * @SWG\Resource(
 *      apiVersion="1.0",
 *      swaggerVersion="1.2",
 *      resourcePath="rate",
 *      basePath="http://video-lyrics.herokuapp.com/1.0",
 *      @SWG\Api(
 *          description="Recommender system.",
 *          path="/rate",
 *          @SWG\Operation(
 *              method="POST",
 *              summary="Rate an object (video, lyrics, music or a custom defined type).",
 *              nickname="rate",
 *              @SWG\Parameter(
 *                  name="objectType",
 *                  required=true,
 *                  allowMultiple=false,
 *                  type="string",
 *                  description="The type of object that will be rated (video, lyrics, music or a custom defined type)."
 *              ),
 *              @SWG\Parameter(
 *                  name="objectID",
 *                  required=true,
 *                  allowMultiple=false,
 *                  type="string",
 *                  description="The ID of the object for which the average rating will be calculated."
 *              ),
 *              @SWG\Parameter(
 *                  name="IP",
 *                  required=true,
 *                  allowMultiple=false,
 *                  type="string",
 *                  description="IP of the machine from which the vote was initiated."
 *              ),
 *              @SWG\Parameter(
 *                  name="rating",
 *                  required=true,
 *                  allowMultiple=false,
 *                  type="integer",
 *                  description="The rating (either -1, 0 or 1) where -1 means a negative rating, 0 means neutral or no rating and 1 means positive rating."
 *              ),
 *              @SWG\ResponseMessage(code=200, message="The vote was saved."),
 *              @SWG\ResponseMessage(code=500, message="The vote could not be saved.")
 *          ),
 *          @SWG\Operation(
 *              method="GET",
 *              summary="Get the average rating of an object (video, lyrics, music or a custom defined type).",
 *              notes="The average rating consists of a number where -1 means negative, 1 means positive, 0 means neutral and everything in between is also possible.",
 *              nickname="videoRating",
 *              @SWG\Parameter(
 *                  name="objectType",
 *                  required=true,
 *                  allowMultiple=false,
 *                  type="string",
 *                  description="The type of object for which the average rating will be returned."
 *              ),
 *              @SWG\Parameter(
 *                  name="objectID",
 *                  required=false,
 *                  allowMultiple=false,
 *                  type="string",
 *                  description="The ID of the object for which the average rating will be returned. If no ID is specified, it will return a list of all objects of the specified type with its average rating."
 *              ),
 *              @SWG\ResponseMessage(code=200, message="A response containing a list containing objects with fields objectID (the ID of the object) and avgRating (the average rating)."),
 *              @SWG\ResponseMessage(code=500, message="The rating could not be fetched.")
 *          )
 *      ),
 * )
 */

class RateController extends Controller {

    public function rate_10()
    {
        $input = Input::all();
        $data = array(
            'objectType' => $input['objectType'],
            'objectID' => $input['objectID'],
            'IP' => $input['IP'],
            'score' => $input['rating']
        );
        DB::table('rate')->insert($data);
        return Response::make(array(), 200);
    }

    public function lookup_10()
    {
        $objectType = Input::get('objectType');
        $objectID = Input::get('objectID');
        $scores = array();
        $counts = array();
        $types = array();
        $results = null;
        if ($objectType != null) {
            $results = RateModel::where('objectType', '=', "video");
            if ($objectID != null) {
                $results = $results->where('objectID', '=', array($objectID));
            }
        }
        if ($results == null) {
            $results = RateModel::all();
        } else {
            $results = $results->get();
        }
        $response = array();
        foreach ($results as $result) {
            $objectID = $result['objectID'];
            if (!in_array($result['objectID'], array_keys($scores))) {
                $scores[$objectID] = array();
                $counts[$objectID] = array();
                $types[$objectID] = $result['objectType'];
            }
            if (!in_array($result['IP'], array_keys($scores[$objectID]))) {
                $scores[$objectID][$result['IP']] = 0;
                $counts[$objectID][$result['IP']] = 0;
            }
            $scores[$objectID][$result['IP']] += $result['score'];
            $counts[$objectID][$result['IP']] += 1;
        }
        $avgPerIP = array();
        $avg = array();
        $uniqueVotes = array();
        $votes = array();
        foreach ($scores as $objectID => $subdata) {
            $avgPerIP[$objectID] = array();
            $avg[$objectID] = array();
            $votes[$objectID] = 0;
            foreach ($subdata as $IP => $score) {
                $avgPerIP[$objectID][$IP] = $scores[$objectID][$IP] / $counts[$objectID][$IP];
                $votes[$objectID]++;
            }
        }
        foreach ($avgPerIP as $objectID => $subdata) {
            $avg[$objectID] = 0;
            $uniqueVotes[$objectID] = 0;
            $n = 0;
            foreach ($subdata as $IP => $score) {
                $avg[$objectID] += $score;
                $uniqueVotes[$objectID] += 1;
                $n++;
            }
            if ($n != 0) {
                $avg[$objectID] = $avg[$objectID] / $n;
            }
        }
        foreach ($avg as $objectID => $score) {
            $response[$objectID] = array(
                'type' => $types[$objectID],
                'rating' => $score,
                'uniqueVotes' => $uniqueVotes[$objectID],
                'votes' => $votes[$objectID]
            );
        }

        return Response::make($response, 200);
    }

}
