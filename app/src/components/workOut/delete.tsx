'use client'
import { DeleteWorkOut } from '@/actions/workOut/delete'
import { FormEvent } from 'react'
import { BiTrash } from 'react-icons/bi'

export const DeleteWorkOutComponente = ({ id }: { id: string }) => {
  async function handleDelete(e: FormEvent) {
    e.preventDefault()
    await DeleteWorkOut(id)
  }

  return (
    <button
      onClick={handleDelete}
      className="w-5 h-5 absolute top-2 left-2 hover:text-red-600 transition duration-500"
    >
      <BiTrash className="w-5 h-5" />
    </button>
  )
}
