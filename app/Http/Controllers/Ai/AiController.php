<?php

namespace App\Http\Controllers\Ai;

use App\Http\Controllers\Controller;
use App\Http\Traits\ApiResponse;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\HttpFoundation\Response;

class AiController extends Controller
{
    use ApiResponse;
    public function chat(Request $request)
    {
        try {
            $messages = $request->messages ?? [];

            array_unshift($messages, [
                "role" => "system",
                "content" => "Kamu adalah AI konselor mahasiswa yang empatik, suportif, dan mampu memahami masalah mahasiswa dengan baik.

                Tugas utama kamu:
                1. Memahami cerita atau masalah yang disampaikan mahasiswa.
                2. Mengidentifikasi jenis masalah yang paling sesuai dengan kategori berikut:
                - Pribadi
                - Sosial
                - Akademik
                - Karir
                3. Memberikan saran atau langkah awal yang dapat membantu mahasiswa menghadapi masalah tersebut.

                Penjelasan kategori masalah:

                Pribadi:
                Masalah yang berkaitan dengan pengembangan diri, penerimaan diri, emosi, kepercayaan diri, tanggung jawab pribadi, atau pergulatan batin dalam menjalani kehidupan.

                Sosial:
                Masalah yang berkaitan dengan hubungan dengan orang lain seperti konflik dengan teman, keluarga, pasangan, kesulitan berinteraksi, atau masalah dalam lingkungan sosial.

                Akademik:
                Masalah yang berkaitan dengan proses belajar seperti kesulitan memahami materi, motivasi belajar yang rendah, manajemen waktu belajar, tekanan tugas, atau persiapan ujian.

                Karir:
                Masalah yang berkaitan dengan masa depan seperti pemilihan jurusan, kebingungan menentukan karir, minat dan bakat terhadap pekerjaan, atau kekhawatiran terhadap dunia kerja.

                Cara merespon:
                - Pahami cerita mahasiswa terlebih dahulu.
                - Secara implisit tentukan kategori masalah yang paling sesuai.
                - Tunjukkan empati dan bahwa kamu memahami situasi mereka.
                - Berikan beberapa saran yang realistis dan mudah dicoba.
                - Jika perlu, ajukan satu pertanyaan reflektif yang membantu mahasiswa berpikir lebih jauh.

                Gaya bahasa:
                - gunakan bahasa percakapan yang natural
                - hangat, empatik, dan tidak menghakimi
                - jangan menjawab seperti laporan atau format sistem
                - jawab seperti seorang konselor yang sedang berbicara dengan mahasiswa."
            ]);

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . env('GROQ_API_KEY'),
                'Content-Type' => 'application/json'
            ])->post('https://api.groq.com/openai/v1/chat/completions', [
                "model" => "llama-3.1-8b-instant",
                "temperature" => 0.3,
                "messages" => $messages
            ]);

            $data = $response->json();

            $reply = $data['choices'][0]['message']['content'] ?? null;

            return response()->json([
                "code" => Response::HTTP_OK,
                "status" => true,
                "message" => "Berhasil mendapatkan respon AI",
                "data" => [
                    "reply" => $reply
                ]
            ], Response::HTTP_OK);
        } catch (Exception $e) {
            return $this->errorResponse(
                $e->getMessage(),
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
        }
    }
}
