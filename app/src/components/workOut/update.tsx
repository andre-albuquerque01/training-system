/* eslint-disable react-hooks/exhaustive-deps */
'use client'
import Link from 'next/link'
import { useFormStatus } from 'react-dom'
import { GoArrowLeft } from 'react-icons/go'
import { InputUpdateComponent } from '../form/InputUpdateComponent'
import { FormEvent, Suspense, useEffect, useState } from 'react'
import { WorkOutInterface } from '@/actions/workOut/showWorkOut'
import ShowOneWorkOut from '@/actions/workOut/showOneWorkOut'
import { UpdateWorkOut } from '@/actions/workOut/update'
import { useRouter } from 'next/navigation'

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

export const UpdatetWorkOutComponent = ({ id }: { id: string }) => {
  const [error, setError] = useState('')
  const [data, setData] = useState<WorkOutInterface>()
  const router = useRouter()
  useEffect(() => {
    const handleData = async () => {
      const dt = (await ShowOneWorkOut(id)) as WorkOutInterface
      setData(dt)
    }
    handleData()
  }, [])

  async function handleSubmit(e: FormEvent<HTMLFormElement>) {
    e.preventDefault()

    const formData = new FormData(e.currentTarget)
    const data = Object.fromEntries(formData)
    const req = await UpdateWorkOut(data, id)
    if (req === 'true') {
      alert('Treino alterado com sucesso!')
      router.push('/workOut')
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
        <InputUpdateComponent
          type="text"
          label="Músculo"
          name="muscle"
          id="muscle"
          required={false}
          value={data?.muscle ?? ''}
        />
        <InputUpdateComponent
          type="text"
          label="Equipamento"
          name="equipment"
          id="equipment"
          required={false}
          value={data?.equipment ?? ''}
        />
        <InputUpdateComponent
          type="text"
          label="Dificuldade"
          name="difficulty"
          id="difficulty"
          required={false}
          value={data?.difficulty ?? ''}
        />
        <InputUpdateComponent
          type="text"
          label="Duração"
          name="duration"
          id="duration"
          required={false}
          value={data?.duration ?? ''}
        />
        <InputUpdateComponent
          type="text"
          label="Consumo de calorias"
          name="calories"
          id="calories"
          required={false}
          value={data?.calories ?? ''}
        />
        <InputUpdateComponent
          type="text"
          label="Peso para iniciar"
          name="weight"
          id="weight"
          required={false}
          value={data?.weight ?? ''}
        />
        <InputUpdateComponent
          type="text"
          label="Quantidade de repetições"
          name="repetition"
          id="repetition"
          required={true}
          value={data?.repetition ?? ''}
        />
        <InputUpdateComponent
          type="text"
          label="Link da imagem"
          name="image"
          id="image"
          required={true}
          value={data?.image ?? ''}
        />
        <p className="text-xs text-red-600">{error && error}</p>
        <FormButton />
      </form>
    </Suspense>
  )
}
