'use server'

import ApiAction from '@/functions/data/apiAction'
import apiError from '@/functions/error/apiErro'
import { cookies } from 'next/headers'
import { redirect } from 'next/navigation'

export interface UserInterface {
  name: string
  email: string
}

export default async function User() {
  try {
    const response = await ApiAction('/user/show', {
      headers: {
        Accept: 'application/json',
        Authorization: 'Bearer ' + cookies().get('token')?.value,
      },
      cache: 'no-cache',
      // next: {
      //   revalidate: 30 * 60,
      //   tags: ['user'],
      // },
    })
    const data = await response.json()
    if (data.message === 'Unauthenticated.' || !data) {
      cookies().delete('token')
      redirect('/')
    }

    return data.data
  } catch (error) {
    return apiError(error)
  }
}
