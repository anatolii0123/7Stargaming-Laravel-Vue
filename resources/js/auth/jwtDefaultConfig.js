export default {
    // Endpoints
    //registerEndpoint: '/jwt/register',
    loginEndpoint: '/jwt/login',
    refreshEndpoint: '/jwt/refresh',
    logoutEndpoint: '/jwt/logout',
    userDataEndpoint: '/jwt/user',

    // This will be prefixed in authorization header with token
    // e.g. Authorization: Bearer <token>
    tokenType: 'Bearer',

    // Value of this property will be used as key to store JWT token in storage
    storageTokenKeyName: 'accessToken',
    storageRefreshTokenKeyName: 'refreshToken',

    //User data
    userData: 'userData'
}
