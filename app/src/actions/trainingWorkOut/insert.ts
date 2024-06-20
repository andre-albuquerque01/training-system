'use server'

import ApiAction from '@/functions/data/apiAction'
import { RevalidateTag } from '@/functions/data/revalidateTag'
import { cookies } from 'next/headers'

export async function InsertTrainingWorkOut(request: object) {
  try {
    const response = await ApiAction('/trainingWorkOut', {
      method: 'POST',
      headers: {
        Accept: 'application/json',
        Authorization: 'Bearer ' + cookies().get('token')?.value,
        'Content-type': 'application/json',
      },
      body: JSON.stringify(request),
    })

    const data = await response.json()

    const message =
      typeof data.message === 'string'
        ? data.message
        : JSON.stringify(data.message)

    if (message && message.includes('The email has already been taken.'))
      throw new Error('E-mail já cadastrado!')
    RevalidateTag('training')
  } catch (error) {
    return 'Error'
  }
}
