<?php

namespace App\Repositories;

use App\Interfaces\CommentRepositoryInterface;
use App\Interfaces\EmailRepositoryInterface;
use App\Interfaces\UserRepositoryInterface;
use App\Models\Email;
use App\Repositories\BaseRepository;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class EmailRepository implements EmailRepositoryInterface
{

    protected $repositoryComment;
    protected $repositoryUser;

    public function __construct(CommentRepositoryInterface $repositoryComment, UserRepositoryInterface $repositoryUser)
    {
        $this->repositoryComment = $repositoryComment;
        $this->repositoryUser = $repositoryUser;
    }

    protected function getTokenApiGf()
    {
        $URL_API = 'https://api.grupoflesan.com/api/';
        $response = Http::post(
            "{$URL_API}login",
            [
                'username' => 'rgutierrez@flesan.com.pe',
                'password' => 'm#st3R!'
            ]
        );
        $data = $response->json();
        $access_token = $data['access_token'];
        return $access_token;
    }

    protected function sendEmailGf($body, $subject, $emails_to)
    {
        $URL_API = 'https://api.grupoflesan.com/api/';
        $token = self::getTokenApiGf();
        $headers = [
            'Authorization' => "Bearer $token"
        ];
        $data = [
            'cuerpo' => $body,
            'asunto' => $subject,
            'destinatarios' => $emails_to,
            'cabecera_img' => ''
        ];
        $response = Http::withHeaders($headers)->post(
            "{$URL_API}sendNotificacionVacia",
            $data
        );
        return $response;
    }

    public function sendEmailNewComment($id)
    {

        $comment = $this->repositoryComment->findById($id, ['*'], ['standard']);

        $users = $this->repositoryUser->getUserByRol(env('ROL_ADMINISTRADOR'));

        $emails_to = '';
        $emailsArray = array();
        foreach ($users as $key => $value) {
            array_push($emailsArray, $value['username']);
        }
        $emails_to = implode(',', $emailsArray);
        $body = View::make('emails.NewComment', [
            'comment' => $comment
        ])->render();
        $subject = 'PORTAL DE ESTÁNDARES INMOBILIARIOS | NUEVO COMENTARIO';
        return self::sendEmailGf($body, $subject, $emails_to);
    }
}
