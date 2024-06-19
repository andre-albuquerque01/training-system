'use server'

import ApiAction from '@/functions/data/apiAction'
import { RevalidateTag } from '@/functions/data/revalidateTag'
import apiError from '@/functions/error/apiErro'
import { cookies } from 'next/headers'
import { redirect } from 'next/navigation'

export async function InsertWorkOut(
  state: { ok: boolean; error: string; data: null },
  request: FormData,
) {
  const name = request.get('name') as string | null
  const description = request.get('description') as string | null
  const repetition = request.get('repetition') as string | null
  const image = request.get('image') as string | null

  try {
    if (!name || !description || !repetition || !image) {
      throw new Error('Preenchas os dados!')
    }

    const response = await ApiAction('/work', {
      method: 'POST',
      headers: {
        Accept: 'application/json',
        Authorization: 'Bearer ' + cookies().get('token')?.value,
      },
      body: request,
    })

    const data = await response.json()

    const message =
      typeof data.message === 'string'
        ? data.message
        : JSON.stringify(data.message)

    if (
      message &&
      message.includes('The description field must be at least 2 characters.')
    )
      throw new Error('O campo descrição tem que ter mais de 5 caracteres')
    if (
      message &&
      message.includes('The image field must be at least 2 characters.')
    )
      throw new Error('O campo imagem tem ter mais de 10 caracteres.')
  } catch (error) {
    return apiError(error)
  }
  RevalidateTag('workOut')
  redirect('/workOut')
}
