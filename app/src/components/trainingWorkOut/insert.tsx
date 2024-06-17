'use client'
import { InsertTrainingWorkOut } from '@/actions/trainingWorkOut/insert'
import { useRouter } from 'next/navigation'
import { FormEvent } from 'react'
import { CiCirclePlus } from 'react-icons/ci'

export const InsertTrainingWorkOutComponente = ({
  idWorkOut,
  idTrainingType,
}: {
  idWorkOut: string
  idTrainingType: string
}) => {
  const router = useRouter()

  async function handleDelete(e: FormEvent) {
    e.preventDefault()
    await InsertTrainingWorkOut({
      workOut_id: idWorkOut,
      trainingType_id: idTrainingType,
    })
    router.back()
  }

  return (
    <button
      onClick={handleDelete}
      className="flex items-center gap-1 hover:text-red-500"
    >
      <CiCirclePlus className="w-5 h-5 absolute top-2 left-2" />
    </button>
  )
}
