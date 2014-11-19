<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 11/18/14
 * Time: 7:24 PM
 */

class RateController extends BaseController {

    /**
     * @SWG\Resource(
     *      apiVersion="1.0",
     *      swaggerVersion="1.2",
     *      resourcePath="/video",
     *      basePath="video-lyrics.herokuapp.com",
     *      @SWG\Api(
     *          description="Video recommender system.",
     *          path="video/rate",
     *          @SWG\Operation(
     *              method="POST",
     *              summary="Rate a video.",
     *              nickname="rateVideo",
     *              @SWG\Parameter(
     *                  name="videoID",
     *                  required=true,
     *                  allowMultiple=false,
     *                  type="string",
     *                  description="The ID of the video for which the average rating will be calculated."
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
     *              summary="Get the average rating of a video.",
     *              notes="The average rating consists of a number where -1 means negative, 1 means positive, 0 means neutral and everything in between is also possible.",
     *              nickname="videoRating",
     *              @SWG\Parameter(
     *                  name="videoID",
     *                  required=false,
     *                  allowMultiple=false,
     *                  type="string",
     *                  description="The ID of the video for which the average rating will be calculated. If no ID is specified, a list of all video and average ratings is returned."
     *              ),
     *              @SWG\ResponseMessage(code=200, message="A response containing the average rating of all ratings for the requested video."),
     *              @SWG\ResponseMessage(code=500, message="The rating could not be fetched.")
     *          )
     *      ),
     * )
     *
     * @SWG\Resource(
     *      apiVersion="1.0",
     *      swaggerVersion="1.2",
     *      resourcePath="/music",
     *      basePath="http://video-lyrics.herokuapp.com/1.0/",
     *      @SWG\Api(
     *          description="Music search engine.",
     *          path="music/search",
     *          @SWG\Operation(
     *              method="GET",
     *              summary="Search for a song.",
     *              nickname="musicSearch",
     *              @SWG\Parameter(
     *                  name="query",
     *                  required=true,
     *                  allowMultiple=false,
     *                  type="string",
     *                  description="The query used to search for songs."
     *              ),
     *              @SWG\Parameter(
     *                  name="offset",
     *                  required=false,
     *                  allowMultiple=false,
     *                  type="string",
     *                  description="The first few items (specified by the offset parameter) will not be included in the results (no offset as default)."
     *              ),
     *              @SWG\Parameter(
     *                  name="items",
     *                  required=false,
     *                  allowMultiple=false,
     *                  type="string",
     *                  description="The maximal number of items that will be returned (0 means no limit)."
     *              ),
     *              @SWG\ResponseMessage(code=200, message="A response containing a list of relevant songs and their corresponding information."),
     *              @SWG\ResponseMessage(code=500, message="The query could not be executed.")
     *          )
     *      ),
     *      @SWG\Api(
     *          description="Track information.",
     *          path="music/info",
     *          @SWG\Operation(
     *              method="GET",
     *              summary="Retrieve information about a song.",
     *              nickname="musicInfo",
     *              @SWG\Parameter(
     *                  name="songID",
     *                  required=true,
     *                  allowMultiple=false,
     *                  type="string",
     *                  description="The ID of a song to retrieve information from."
     *              ),
     *              @SWG\ResponseMessage(code=200, message="A response containing corresponding information about the song."),
     *              @SWG\ResponseMessage(code=500, message="The query could not be executed.")
     *          )
     *      )
     * )
     */
    public function rateVideo()
    {
        echo 'test';
        $ratings = Rate::all();
        foreach ($ratings as $rating) {
            var_dump($rating);
        }
        die();
    }

}
