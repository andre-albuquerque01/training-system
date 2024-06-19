/* eslint-disable react-hooks/exhaustive-deps */
'use client'
import Link from 'next/link'
import { useFormStatus } from 'react-dom'
import { GoArrowLeft } from 'react-icons/go'
import { InputUpdateComponent } from '../form/InputUpdateComponent'
import ShowOneTrainingType, {
  TrainingTypeInterface,
} from '@/actions/trainingType/showOneTraining'
import { FormEvent, Suspense, useEffect, useState } from 'react'
import { useRouter } from 'next/navigation'
import { UpdateTrainingType } from '@/actions/trainingType/update'

function FormButton() {
  const { pending } = useFormStatus()

  return (
    <>
      {pending ? (
        <button
          className="bg-blue-600 text-white px-4 py-2 w-96 max-md:w-80 max-md:mx-auto rounded-lg"
          disabled={pending}
        >
          Alterando...
        </button>
      ) : (
        <button
          className="bg-blue-600 text-white px-4 py-2 w-96 max-md:w-80 max-md:mx-auto rounded-lg"
          disabled={pending}
        >
          Alterar
        </button>
      )}
    </>
  )
}

export const UpdateTrainingComponent = ({ id }: { id: string }) => {
  const [error, setError] = useState('')
  const [data, setData] = useState<TrainingTypeInterface>()
  const router = useRouter()
  useEffect(() => {
    const handleData = async () => {
      const dt = (await ShowOneTrainingType(id)) as TrainingTypeInterface
      setData(dt)
    }
    handleData()
  }, [])

  async function handleSubmit(e: FormEvent<HTMLFormElement>) {
    e.preventDefault()

    const formData = new FormData(e.currentTarget)
    const data = Object.fromEntries(formData)
    const req = await UpdateTrainingType(data, id)
    if (req === 'true') {
      alert('Treino alterado com sucesso!')
      router.back()
    }
    if (req === 'false') setError('Erro ao fazer alteração!')
    if (req !== 'true' && req !== 'false') setError(req)
  }

  return (
    <Suspense>
      <form
        className="space-y-2 flex flex-col text-black"
        onSubmit={handleSubmit}
      >
        <Link href="/workOut" className="flex items-center">
          <GoArrowLeft className="w-5 h-5" /> Voltar
        </Link>
        <InputUpdateComponent
          type="text"
          label="Titúlo"
          name="name"
          id="name"
          required={true}
          value={data?.name ?? ''}
        />
        <InputUpdateComponent
          type="text"
          label="Descrição"
          name="description"
          id="description"
          required={true}
          value={data?.description ?? ''}
        />
        <p className="text-xs text-red-600">{error && error}</p>
        <FormButton />
      </form>
    </Suspense>
  )
}
