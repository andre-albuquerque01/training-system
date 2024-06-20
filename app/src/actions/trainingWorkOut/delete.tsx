'use server'

import ApiAction from '@/functions/data/apiAction'
import { RevalidateTag } from '@/functions/data/revalidateTag'
import apiError from '@/functions/error/apiErro'
import { cookies } from 'next/headers'

export async function DeleteTrainingWorkOut(idTrainingWorkOut: string) {
  try {
    if (!idTrainingWorkOut) {
      throw new Error('Preenchas os dados!')
    }
    await ApiAction(`/trainingWorkOut/destroyWorkOut/${idTrainingWorkOut}`, {
      method: 'DELETE',
      headers: {
        Accept: 'application/json',
        Authorization: 'Bearer ' + cookies().get('token')?.value,
      },
    })
  } catch (error) {
    return apiError(error)
  }
  RevalidateTag('training')
}
