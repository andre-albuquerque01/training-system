'use server'

import ApiAction from '@/functions/data/apiAction'
import { RevalidateTag } from '@/functions/data/revalidateTag'
import apiError from '@/functions/error/apiErro'
import { cookies } from 'next/headers'
import { redirect } from 'next/navigation'

export async function DeleteTrainingType(idTrainingType: string) {
  try {
    if (!idTrainingType) {
      throw new Error('Preenchas os dados!')
    }

    const response = await ApiAction(`/trainingType/${idTrainingType}`, {
      method: 'DELETE',
      headers: {
        Accept: 'application/json',
        Authorization: 'Bearer ' + cookies().get('token')?.value,
      },
    })

    const data = await response.json()

    const message =
      typeof data.message === 'string'
        ? data.message
        : JSON.stringify(data.message)

    if (message && message.includes('Error'))
      throw new Error('Item já excluído ou não existe na base de dados.')
  } catch (error) {
    return apiError(error)
  }
  RevalidateTag('training')
  redirect('/dashboard')
}
