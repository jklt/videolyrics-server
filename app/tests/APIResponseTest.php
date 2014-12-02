<?php

class APIResponseTest extends TestCase {

    /**
     * Test the response of the rate API.
     *
     * @return void
     */
    public function testRateResponse()
    {
        // Response test
        $this->client->request('GET', '/1.0/rate?objectType=video');
        $this->assertTrue($this->client->getResponse()->isOk());

        // Behavioural test
        $this->client->request('POST', '/1.0/rate?objectType=video', array(
            'objectType' => 'video',
            'objectID' => -1,
            'IP' => '123.123.123.123',
            'rating' => 0.10
        ));
        $this->client->request('GET', '/1.0/rate?objectType=video');
        $result = $this->client->getResponse()->getContent();
        // Test format
        $this->assertTrue($this->isValidJSON($result));
        // Test whether the created vote is in the list of votes
        $data = json_decode($result);
        $found = false;
        foreach ($data as $key => $value) {
            if ($key == -1) {
                $found = true;
            }
        }
        $this->assertTrue($found);
    }

    /**
     * Test the response of the proxy YouTube API.
     *
     * @return void
     */
    public function testYouTubeAPI()
    {
        $this->client->request('GET', '/1.0/proxy/youtube/search?maxResults=1&part=id&q=Coldplay+Yellow&type=video&videoEmbeddable=true');
        // Test format
        $this->assertTrue($this->isValidJSON($this->client->getResponse()->getContent()));
        // Test response
        $this->assertTrue($this->client->getResponse()->isOk());
    }

    /**
     * Test the response of the proxy ChartLyrics API.
     *
     * @return void
     */
    public function testChartLyricsAPI()
    {
        $this->client->request('GET', '/1.0/proxy/chartlyrics/SearchLyricDirect?artist=coldplay&song=yellow');
        // Test response
        $this->assertTrue($this->client->getResponse()->isOk());
    }

    /**
     * Test the response of the proxy Spotify API.
     *
     * @return void
     */
    public function testSpotifyAPI()
    {
        $this->client->request('GET', '/1.0/proxy/spotify/tracks/3AJwUDP919kvQ9QcozQPxg');
        // Test format
        $this->assertTrue($this->isValidJSON($this->client->getResponse()->getContent()));
        // Test response
        $this->assertTrue($this->client->getResponse()->isOk());
    }

    /**
     * Helper method to test whether the output is valid JSON.
     */
    private function isValidJSON($data) {
        json_decode($data);
        if (json_last_error() != 0) {
            return false;
        }
        return true;
    }

}
