'use server'

import ApiAction from '@/functions/data/apiAction'
import apiError from '@/functions/error/apiErro'
import { cookies } from 'next/headers'
import { redirect } from 'next/navigation'
import { TrainingInterface } from './showTraining'

export interface TrainingTypeInterface {
  id: string
  name: string
  description: string
  updated_at: string
  userId: string
  training?: TrainingInterface[]
}

export default async function ShowOneTrainingType(id: string) {
  try {
    const response = await ApiAction(`/trainingType/${id}`, {
      headers: {
        Accept: 'application/json',
        Authorization: 'Bearer ' + cookies().get('token')?.value,
      },
      cache: 'no-cache',
      // next: {
      //   revalidate: 30 * 60,
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
