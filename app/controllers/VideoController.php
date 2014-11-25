<?php
/**
 * @SWG\Resource(
 *      apiVersion="1.0",
 *      swaggerVersion="1.2",
 *      resourcePath="video",
 *      basePath="http://video-lyrics.herokuapp.com/1.0",
 *      @SWG\Api(
 *          description="Video look-up engine.",
 *          path="/video",
 *          @SWG\Operation(
 *              method="GET",
 *              summary="Look-up a video.",
 *              nickname="video",
 *              @SWG\Parameter(
 *                  name="videoID",
 *                  required=true,
 *                  allowMultiple=false,
 *                  type="string",
 *                  description="The ID of a video. If nothing is specified, a list containing all videos is returned."
 *              ),
 *              @SWG\ResponseMessage(code=200, message="A response containing an object with fields videoID (the ID of the video) and URL (the URL of the video). If nothing was found, then false will be returned."),
 *              @SWG\ResponseMessage(code=500, message="The query could not be executed.")
 *          )
 *      )
 * )
 */

class VideoController extends Controller {

    public function lookUp_10($path)
    {
        $params = Input::all();
        $API = new APIModel('https://www.googleapis.com/youtube/v3/', ['key' => 'AIzaSyBf6lUGqowSjbJNC7eL61cPS2mBj8wF2NM']);
        $result = $API->call(Request::method(), $path, $params);
        return Response::make($result, 200);
    }

}
