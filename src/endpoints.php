<?php

class endpoints
{
    public string $UrlPadrao;
    public string $urlVerificarBanco;
    public string $urlME;
    public string $urlVerifyEmail;
    public string $urlRefreshToken;
    public string $Cadastro;
    public string $urlLogin;
    public string $urlEsqueceuSenha;
    public string $urlResetSenha;
    public string $urlLoginVerify;
    public string $urlVerificationSession;
    public string $urlLogoutSession;
    public string $urlLogoutAllSession;
    public string $urlLoginNewCode;
    public string $urlEmailVerifyNewCode;
    public string $urlProvider;
    public string $urlListing;
    public string $urlRentals;


    public function __construct()
    {
        $this->UrlPadrao = "https://addressing-fingers-corps-pizza.trycloudflare.com";

        $this->urlVerificarBanco = $this->UrlPadrao . "/api/v1/user-access/health/db";
        $this->urlME = $this->UrlPadrao . "/api/v1/user-access/user/me";
        $this->urlVerifyEmail  = $this->UrlPadrao . "/api/v1/user-access/auth/email-verification/verify-email";
        $this->urlRefreshToken = $this->UrlPadrao . "/api/v1/user-access/auth/refresh-tokens";
        $this->Cadastro = $this->UrlPadrao . "/api/v1/user-access/auth/register";
        $this->urlLogin = $this->UrlPadrao . "/api/v1/user-access/auth/login";
        $this->urlEsqueceuSenha = $this->UrlPadrao . "/api/v1/user-access/auth/forgot-password";
        $this->urlResetSenha = $this->UrlPadrao . "/api/v1/user-access/auth/reset-password";
        $this->urlLoginVerify = $this->UrlPadrao . "/api/v1/user-access/auth/login/verify";
        $this->urlVerificationSession = $this->UrlPadrao . "/api/v1/user-access/identity-verification/session";
        $this->urlLogoutSession = $this->UrlPadrao . "/api/v1/user-access/auth/logout-current-session";
        $this->urlLogoutAllSession = $this->UrlPadrao . "/api/v1/user-access/auth/logout-all-sessions";
        $this->urlLoginNewCode = $this->UrlPadrao . "/api/v1/user-access/auth/login/request-new-code";
        $this->urlEmailVerifyNewCode = $this->UrlPadrao . "/api/v1/user-access/auth/email-verification/request-new-code";
        $this->urlProvider = $this->UrlPadrao . "/api/v1/user-access/user/me/provider";
        $this->urlListing = $this->UrlPadrao . "/api/v1/listings";
        $this->urlRentals = $this->UrlPadrao . "/api/v1/rentals";

    }
}

?>