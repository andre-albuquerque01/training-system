'use server'

import ApiAction from '@/functions/data/apiAction'
import apiError from '@/functions/error/apiErro'
import { cookies } from 'next/headers'
import { redirect } from 'next/navigation'

export async function DeleteTrainingType(idTrainingWorkOut: string) {
  try {
    if (!idTrainingWorkOut) {
      throw new Error('Preenchas os dados!')
    }

    const response = await ApiAction(`/trainingType/${idTrainingWorkOut}`, {
      method: 'DELETE',
      headers: {
        Accept: 'application/json',
        Authorization: 'Bearer ' + cookies().get('token')?.value,
      },
    })

    const data = await response.json()
    console.log(data)

    const message =
      typeof data.message === 'string'
        ? data.message
        : JSON.stringify(data.message)

    if (message && message.includes('The email has already been taken.'))
      throw new Error('E-mail já cadastrado!')
  } catch (error) {
    return apiError(error)
  }
  redirect('/')
}
