<?php

/**
 * @SWG\Resource(
 *      apiVersion="1.0",
 *      swaggerVersion="1.2",
 *      resourcePath="music",
 *      basePath="http://video-lyrics.herokuapp.com/1.0",
 *      @SWG\Api(
 *          description="Music look-up engine.",
 *          path="/music/list/",
 *          @SWG\Operation(
 *              method="GET",
 *              summary="List music.",
 *              nickname="musicList",
 *              @SWG\Parameter(
 *                  name="query",
 *                  required=false,
 *                  allowMultiple=false,
 *                  type="string",
 *                  description="The query used to search for music. If no query was used, then it will list everything."
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
 *              @SWG\ResponseMessage(code=200, message="A response containing a list of objects with field musicID (the ID of the music)."),
 *              @SWG\ResponseMessage(code=500, message="The query could not be executed.")
 *          )
 *      ),
 *      @SWG\Api(
 *          description="Music information.",
 *          path="/music/",
 *          @SWG\Operation(
 *              method="GET",
 *              summary="Retrieve information about music.",
 *              nickname="musicInfo",
 *              @SWG\Parameter(
 *                  name="songID",
 *                  required=true,
 *                  allowMultiple=false,
 *                  type="string",
 *                  description="The ID of a song to retrieve information from."
 *              ),
 *              @SWG\ResponseMessage(code=200, message="A response containing an object with fields musicID (the ID of the music), lyricsID (the ID of the lyrics), videoID (the ID of the video), title (the title of the music), image (the image for the music), image-thumbnail (a thumbnail of the image). If nothing was found, then false will be returned."),
 *              @SWG\ResponseMessage(code=500, message="The query could not be executed.")
 *          )
 *      )
 * )
 */

class MusicController extends Controller {

    public function lookUp_10()
    {
        $musicDB = new MusixMatchModel();
        $musicDB->lookUp('coldplay');
    }

    public function find_10()
    {

    }

}
