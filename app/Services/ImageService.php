<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Psr7\Request;
use App\Traits\CanLog;
use Aws\AwsClient;
use Aws\Laravel\AwsFacade;

class ImageService
{

    /**
     * @var Client
     */
    protected $client;

    /**
     * @var string
     */
    protected $filename;

    public function __construct()
    {
        $this->client = AwsFacade::createClient('rekognition');
    }

    /**
     * @param array $data
     *
     * @return \stdClass
     */
    public function analyse($data)
    {
        $result = isset ($data['image']) ? ['score'=>0,'message'=>'Image does not seem to match category, use another'] : ['score'=>0,'message'=>'Image not provided'];

        if(isset ($data['image'])){
            $result = ['score'=>0,'message'=>'Image does not seem to match category, use another'];
            try {
                $this->filename = $this->getImageFromUrl($data['image']);

                $fp_image = fopen('images/' . $this->filename, 'r');
                $image = fread($fp_image, filesize('images/' . $this->filename));
                fclose($fp_image);

                $response = $this->client->detectLabels([
                    'Image' => [
                        'Bytes'=>$image
                    ]
                ]);

                foreach ($response['Labels'] as $label) {
                    if (
                        strpos(
                            strtolower($label['Name']),
                            strtolower(str_singular($data['category']))) !== false) {

                        $score = round($label['Confidence']/100,2);

                        if ($label['Confidence'] >= 70) {
                            $result = ['score'=>$score,'message'=>'Image is correct'];

                            return $result;
                        }
                        if ($label['Confidence'] < 70 && $label['Confidence'] >= 40) {
                            $result = ['score'=>$score,'message'=>'Image is correct, but you may want use another'];
                            return $result;
                        }
                        if ($label['Confidence'] < 40) {
                            $result = ['score'=>$score,'message'=>'Image does not seem to match category, use another'];
                            return $result;
                        }
                    }
                }


            } catch (\Exception $exception) {
                \Log::error($exception);
            }
        }
        else {
            $result = ['score'=>0,'message'=>'Image not provided'];
        }

        return  $result;
    }

    /**
     * @param $url
     *
     */
    protected function getImageFromUrl($url)
    {
        //temporarily store image as we prepare to send it to the API.

        $url_segments = explode("/", $url);

        $url_segments = array_reverse($url_segments);

        copy($url, 'images/' . $url_segments[0]);

        return $url_segments[0];
    }

}
