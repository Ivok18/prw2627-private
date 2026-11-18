<?php

require_once "model/Member.php";
require_once "model/Message.php";
require_once "framework/View.php";
require_once "framework/Controller.php";



class ControllerMessage extends Controller {

    /** 
     * affiche les messages du membre connecté, 
     * ou ceux du pseudo reçu dans param1. 
     * Cette action traite aussi l'envoi du formulaire. 
     * Si le message est valide, elle l'enregistre puis redirige vers ces mêmes messages. 
     * Sinon, elle réaffiche le formulaire 
     * avec le body et la case Private message tels qu'ils ont été envoyés. */
    public function index(): void {
        /// ETAPES
        // 1] on verifie si un pseudo est reçu
        //.. si oui on affiche les messages du membre correspondant
        //.. si non on affiche les messages du membre connecté
        
        
        // 2] on verifie si body est valide
        //.. si oui on ajoute le message et on reaffiche la page avec les messages de l'utilisateur courant
        //.. si non on reaffiche la page, avec body et la case private message cochée comme ça a été envoyé

        $user = $this->get_user_id_or_redirect();
        $user = Member::get_member_by_pseudo($user);
        $recipient = $this->get_recipient($user);
        $errors = [];
        $body = $_POST["body"] ?? null;
        $private = false;
        if ($body !== null) {
            $private = isset($_POST["private"]);
            $message = new Message($user, $recipient, trim($body), $private);
            $errors = $message->validate();
            if ($errors === []) {
                $errors = $user->write_message($message);
            }
            if ($errors === []) {
                $this->redirect("message", "index",$recipient->get_pseudo());
            }
        }
        $body = $body ?? "";
        (new View("messages"))->show([
            "recipient" => $recipient,
            "body" => $body,
            "errors" => $errors,
            "user" => $user,
            "private" => $private
        ]);
        
    }

    /**
     * lit l'identifiant dans $_POST["id_message"]. 
     * Si l'identifiant est invalide ou manquant, 
     * ou si le membre connecté n'a pas le droit de supprimer ce message, la méthode lance une exception. 
     * Après une suppression réussie, elle redirige vers les messages du destinataire.
     */
    public function delete(): void {
        /// ETAPES
        // 1] on verifie si l'identifiant est invalide, manquant ou si pas le droit de supprimer 
        //.. si un des 3 => exception
        //.. sinon on supprime le message de la db et on reaffiche la page messages du destinataire du message
        $user = $this->get_user_id_or_redirect();
        $post_id = filter_var($_POST["id_message"] ?? "", FILTER_VALIDATE_INT);
        if ($post_id === false) {
            Tools::abort("Wrong/missing param or action no permitted");
        }
        $message = Message::get_message($post_id);
        if ($message === false || !$message->can_be_deleted_by($user)) {
            Tools::abort("Wrong/missing param or action no permitted");
        }
        $message->delete($user);
        $this->redirect("message", "index",$message->get_recipient()->get_pseudo());
    }    

    public function get_recipient(Member $user): Member {
        $pseudo = trim($_GET["param1"] ?? "");
        if ($pseudo === "") {
            return $user;
        }
        $recipient = Member::get_member_by_pseudo($pseudo);
        if ($recipient === false) {
            throw new Exception("Unknown member");
        }
        return $recipient;
    }


}
?>
