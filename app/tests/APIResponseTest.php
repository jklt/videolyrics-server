<?php

class APIResponseTest extends TestCase {

    /**
     * Test the response of the rate API.
     *
     * @return void
     */
    public function testRateResponse()
    {
        $crawler = $this->client->request('GET', '/1.0/rate?objectType=video');
        $this->assertTrue($this->client->getResponse()->isOk());
    }

    /**
     * Test the response of the proxy Spotify API.
     *
     * @return void
     */
    public function testSpotifyAPI()
    {
        $crawler = $this->client->request('GET', '/1.0/proxy/musixmatch/track.search?q=coldplay');
        $this->assertTrue($this->client->getResponse()->isOk());
    }

}
