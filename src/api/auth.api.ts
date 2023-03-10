import { httpApi } from '@app/api/http.api';
// import './mocks/auth.api.mock';
import { UserModel } from '@app/domain/UserModel';

export interface AuthData {
  email: string;
  password: string;
}

export interface SignUpRequest {
  firstName: string;
  lastName: string;
  email: string;
  password: string;
}

export interface ResetPasswordRequest {
  email: string;
}

export interface SecurityCodePayload {
  code: string;
}

export interface NewPasswordData {
  newPassword: string;
}

export interface LoginRequest {
  username: string;
  password: string;
}

export interface LoginResponse {
  accessToken: string;
  user: UserModel;
}

export interface AuthResponse {
  data: LoginResponse;
}

export const login = (loginPayload: LoginRequest): Promise<AuthResponse> =>
  httpApi
    .post<AuthResponse>('api/v1/user/login', { ...loginPayload })
    .then(({ data }) => data)
    .catch((e) => e);

export const signUp = (signUpData: SignUpRequest): Promise<undefined> =>
  httpApi.post<undefined>('signUp', { ...signUpData }).then(({ data }) => data);

export const resetPassword = (
  resetPasswordPayload: ResetPasswordRequest,
): Promise<undefined> =>
  httpApi
    .post<undefined>('forgotPassword', { ...resetPasswordPayload })
    .then(({ data }) => data);

export const verifySecurityCode = (
  securityCodePayload: SecurityCodePayload,
): Promise<undefined> =>
  httpApi
    .post<undefined>('verifySecurityCode', { ...securityCodePayload })
    .then(({ data }) => data);

export const setNewPassword = (
  newPasswordData: NewPasswordData,
): Promise<undefined> =>
  httpApi
    .post<undefined>('setNewPassword', { ...newPasswordData })
    .then(({ data }) => data);
