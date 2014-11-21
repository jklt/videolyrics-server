<?php

/**
 * @SWG\Resource(
 *      apiVersion="1.0",
 *      swaggerVersion="1.2",
 *      resourcePath="lyrics",
 *      basePath="http://video-lyrics.herokuapp.com/1.0",
 *      @SWG\Api(
 *          description="Lyrics look-up engine.",
 *          path="/lyrics/",
 *          @SWG\Operation(
 *              method="GET",
 *              summary="Look-up lyrics.",
 *              nickname="lyrics",
 *              @SWG\Parameter(
 *                  name="lyricsID",
 *                  required=true,
 *                  allowMultiple=false,
 *                  type="string",
 *                  description="The ID of the lyrics. If nothing is specified, a list containing all lyrics is returned."
 *              ),
 *              @SWG\ResponseMessage(code=200, message="A response containing an object with fields lyricsID (the ID of the lyrics) and lyrics (the lyrics themselves). If nothing was found, then false will be returned."),
 *              @SWG\ResponseMessage(code=500, message="The query could not be executed.")
 *          )
 *      )
 * )
 */

class LyricsController extends Controller {

    public function lookUp_10()
    {

    }

}
