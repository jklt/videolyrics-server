<?php
/**
 * @SWG\Resource(
 *      apiVersion="1.0",
 *      swaggerVersion="1.2",
 *      resourcePath="video",
 *      basePath="http://video-lyrics.herokuapp.com/1.0",
 *      @SWG\Api(
 *          description="Video look-up engine (YouTube proxy).",
 *          path="/proxy/youtube",
 *          @SWG\Operation(
 *              method="GET",
 *              summary="Proxy to the YouTube API. For example, you can call /video/search just like you would call search on the YouTube API.",
 *              nickname="music",

 *              @SWG\ResponseMessage(code=200, message="A response from the YouTube API."),
 *              @SWG\ResponseMessage(code=500, message="The query could not be executed.")
 *          )
 *      )
 * )
 */

class VideoController extends Controller {

    public function lookUpYouTube_10($path)
    {
        $params = Input::all();
        $API = new APIModel('https://www.googleapis.com/youtube/v3/', ['key' => 'AIzaSyBf6lUGqowSjbJNC7eL61cPS2mBj8wF2NM']);
        $result = $API->call(Request::method(), $path, $params);
        return Response::make($result, 200);
    }

}
