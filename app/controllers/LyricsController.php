<?php
/**
 * @SWG\Resource(
 *      apiVersion="1.0",
 *      swaggerVersion="1.2",
 *      resourcePath="lyrics",
 *      basePath="http://video-lyrics.herokuapp.com/1.0",
 *      @SWG\Api(
 *          description="Lyrics scraper (DirectLyrics).",
 *          path="/scraper/lyrics",
 *          @SWG\Operation(
 *              method="GET",
 *              summary="Scraper for lyrics.",
 *              nickname="lyrics",

 *              @SWG\ResponseMessage(code=200, message="A response from the Spotify API."),
 *              @SWG\ResponseMessage(code=500, message="The query could not be executed.")
 *          )
 *      )
 * )
 */

class LyricsController extends Controller {

    public function scrapeLyrics_10()
    {
        $scraper = new LyricsModel();
        $result = $scraper->scrape(Input::get('q'));
        return Response::make($result, 200);
    }

    public function scrapeAllLyrics_10($year, $month)
    {
        $scraper = new LyricsModel();
        $scraper->scrapeAll($year, $month);
    }

}
