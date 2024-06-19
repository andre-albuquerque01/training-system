'use server'

import ApiAction from '@/functions/data/apiAction'
import { RevalidateTag } from '@/functions/data/revalidateTag'
import { cookies } from 'next/headers'

export async function UpdateTrainingType(reqBody: object, id: string) {
  try {
    const response = await ApiAction(`/trainingType/${id}`, {
      method: 'PUT',
      headers: {
        Accept: 'application/json',
        'Content-Type': 'application/json',
        Authorization: 'Bearer ' + cookies().get('token')?.value,
      },
      body: JSON.stringify(reqBody),
    })

    const data = await response.json()
    console.log(data)

    const message =
      typeof data.message === 'string'
        ? data.message
        : JSON.stringify(data.message)

    if (
      message &&
      message.includes('The description field must be at least 2 characters.')
    )
      return 'O campo descrição tem que ter mais de 5 caracteres'
    if (
      message &&
      message.includes('The image field must be at least 2 characters.')
    )
      return 'O campo imagem tem ter mais de 10 caracteres.'
    if (response.ok) {
      RevalidateTag('training')
      return 'true'
    }
    return 'false'
  } catch (error) {
    return 'Houver error'
  }
}
