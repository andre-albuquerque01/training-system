'use server'

import ApiAction from '@/functions/data/apiAction'
import apiError from '@/functions/error/apiErro'
import { cookies } from 'next/headers'
import { redirect } from 'next/navigation'
import { WorkOutInterface } from '../workOut/showWorkOut'

export interface TrainingInterface {
  idTrainingWorkOut: string
  workOut: WorkOutInterface
}

export default async function ShowTrainingType() {
  try {
    const response = await ApiAction('/trainingType', {
      headers: {
        Accept: 'application/json',
        Authorization: 'Bearer ' + cookies().get('token')?.value,
      },
      next: {
        revalidate: 30 * 60,
        tags: ['training'],
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
