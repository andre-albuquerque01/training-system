'use server'

import ApiAction from '@/functions/data/apiAction'
import { RevalidateTag } from '@/functions/data/revalidateTag'
import apiError from '@/functions/error/apiErro'
import { cookies } from 'next/headers'

export async function DeleteWorkOut(idWorkOut: string) {
  try {
    if (!idWorkOut) {
      throw new Error('Preenchas os dados!')
    }
    await ApiAction(`/work/${idWorkOut}`, {
      method: 'DELETE',
      headers: {
        Accept: 'application/json',
        Authorization: 'Bearer ' + cookies().get('token')?.value,
      },
    })
  } catch (error) {
    return apiError(error)
  }
  RevalidateTag('workOut')
}
