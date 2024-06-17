'use client'
import { DeleteTrainingType } from '@/actions/trainingType/delete'
import { useRouter } from 'next/navigation'
import { FormEvent } from 'react'
import { BiTrash } from 'react-icons/bi'

export const DeleteTrainingComponente = ({ id }: { id: string }) => {
  const router = useRouter()

  async function handleDelete(e: FormEvent) {
    e.preventDefault()
    await DeleteTrainingType(id)
    router.back()
  }

  return (
    <button
      onClick={handleDelete}
      className="flex items-center gap-1 hover:text-red-500"
    >
      <BiTrash className="w-5 h-5" />
      Excluir treino
    </button>
  )
}
