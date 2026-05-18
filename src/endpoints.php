<?php

class endpoints
{
    public string $urlVerificarBanco = "http://localhost:5000/api/v1/user-access/health/db";
    public string $urlME = "http://localhost:5000/api/v1/user-access/user/me";
    public string $urlVerifyEmail = "http://localhost:5000/api/v1/user-access/auth/email-verification/verify-email";
    public string $urlRefreshToken = "http://localhost:5000/api/v1/user-access/auth/refresh-tokens";
    public string $Cadastro = "http://localhost:5000/api/v1/user-access/auth/register";
    public string $urlLogin = "http://localhost:5000/api/v1/user-access/auth/login";
}

?>