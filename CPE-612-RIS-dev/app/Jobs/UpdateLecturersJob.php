<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use GuzzleHttp\Client;
use App\Lecturer;

class UpdateLecturersJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $client = new Client();
        $response = $client->get('https://researchdb.eng.cmu.ac.th/api/v1/lecturers/engineering?key=6kTC5RxDwC531FdK7vrKq0P2F8a6kU3U');

        if ($response->getStatusCode() == 200) {
            $lecturerDatas = json_decode($response->getBody()->getContents(), true);

            foreach ($lecturerDatas as $lecturerData) {
                $lecturerData['researchdb_id'] = $lecturerData['id'];
                unset($lecturerData['id']);
                Lecturer::firstOrCreate([
                    'researchdb_id' => $lecturerData['researchdb_id']
                ], $lecturerData);
            }
        }

    }
}
