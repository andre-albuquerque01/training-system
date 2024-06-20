'use server'

import ApiAction from '@/functions/data/apiAction'
import apiError from '@/functions/error/apiErro'
import VerificationPassword from '@/functions/other/verifyPassword'

export async function UpdatePasswordRecoverUser(
  state: { ok: boolean; error: string; data: null },
  request: FormData,
) {
  const token = request.get('token') as string | null
  const email = request.get('email') as string | null
  const password = request.get('password') as string | null
  const passwordConfirmation = request.get('password_confirmation') as
    | string
    | null

  try {
    if (!token || !email || !password || !passwordConfirmation) {
      throw new Error('Preenchas os dados!')
    }
    if (password !== passwordConfirmation) {
      throw new Error('Senha incompativel!')
    }

    VerificationPassword(password)

    const response = await ApiAction('/user/updateRecoverPassword', {
      method: 'POST',
      headers: {
        accept: 'application/json',
      },
      body: request,
    })

    const data = await response.json()
    const message =
      typeof data.message === 'string'
        ? data.message
        : JSON.stringify(data.message)

    if (message && message.includes('The email has already been taken.'))
      throw new Error('E-mail já cadastrado!')
    return { ok: true, error: '', data: null }
  } catch (error) {
    return apiError(error)
  }
}
