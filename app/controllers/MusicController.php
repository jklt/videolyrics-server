<?php
/**
 * @SWG\Resource(
 *      apiVersion="1.0",
 *      swaggerVersion="1.2",
 *      resourcePath="music",
 *      basePath="http://video-lyrics.herokuapp.com/1.0",
 *      @SWG\Api(
 *          description="Music look-up engine (MusixMatch proxy).",
 *          path="/proxy/musixmatch",
 *          @SWG\Operation(
 *              method="GET",
 *              summary="Proxy to the MusixMatch API. For example, you can call /music/track.search just like you would call track.search on the MusixMatch API.",
 *              nickname="music",

 *              @SWG\ResponseMessage(code=200, message="A response from the MusixMatch API."),
 *              @SWG\ResponseMessage(code=500, message="The query could not be executed.")
 *          )
 *      ),
 *      @SWG\Api(
 *          description="Music look-up engine (Spotify proxy).",
 *          path="/proxy/spotify",
 *          @SWG\Operation(
 *              method="GET",
 *              summary="Proxy to the Spotify API. For example, you can call /music/track.search just like you would call track.search on the MusixMatch API.",
 *              nickname="music",

 *              @SWG\ResponseMessage(code=200, message="A response from the Spotify API."),
 *              @SWG\ResponseMessage(code=500, message="The query could not be executed.")
 *          )
 *      )
 * )
 */

class MusicController extends Controller {

    public function lookUpMusixMatch_10($path)
    {
        $params = Input::all();
        $API = new APIModel('https://musixmatchcom-musixmatch.p.mashape.com/wsr/1.1/', [], ['X-Mashape-Key' => 'M2vWzykqq9mshOXiNMBGQ8fJF1DHp16VbBwjsnyVW3CqW4ZksQ']);
        $result = $API->call(Request::method(), $path, $params);
        return Response::make($result, 200);
    }

    public function lookUpSpotify_10($path)
    {
        $params = Input::all();
        $API = new APIModel('https://api.spotify.com/v1/', [], ['X-Mashape-Key' => 'M2vWzykqq9mshOXiNMBGQ8fJF1DHp16VbBwjsnyVW3CqW4ZksQ']);
        $result = $API->call(Request::method(), $path, $params);
        return Response::make($result, 200);
    }

}
