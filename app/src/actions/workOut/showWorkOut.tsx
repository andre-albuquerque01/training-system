'use serve'
import ApiAction from '@/functions/data/apiAction'
import apiError from '@/functions/error/apiErro'
import { cookies } from 'next/headers'
import { redirect } from 'next/navigation'

export interface WorkOutInterface {
  idWorkOut: string
  name: string
  description: string
  image: string | null
  video: string | null
  muscle: string | null
  equipment: string | null
  difficulty: string | null
  duration: string | null
  calories: string | null
  weight: string | null
  repetition: string | null
  created_at: string
  updated_at: string
  deleted_at: string | null
}

export default async function ShowWorkOut() {
  try {
    const response = await ApiAction(`/work`, {
      headers: {
        Accept: 'application/json',
        Authorization: 'Bearer ' + cookies().get('token')?.value,
      },
      next: {
        revalidate: 30 * 60,
        tags: ['workOut'],
      },
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
