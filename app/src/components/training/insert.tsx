'use client'
import Link from 'next/link'
import { useFormState, useFormStatus } from 'react-dom'
import { GoArrowLeft } from 'react-icons/go'
import { InputComponent } from '@/components/form/inputComponent'
import { InsertTrainingType } from '@/actions/trainingType/insert'

function FormButton() {
  const { pending } = useFormStatus()

  return (
    <>
      {pending ? (
        <button
          className="bg-blue-600 text-white px-4 py-2 w-96 max-md:w-80 max-md:mx-auto rounded-lg"
          disabled={pending}
        >
          Cadastrando...
        </button>
      ) : (
        <button
          className="bg-blue-600 text-white px-4 py-2 w-96 max-md:w-80 max-md:mx-auto rounded-lg"
          disabled={pending}
        >
          Cadastrar
        </button>
      )}
    </>
  )
}

export const InsertTrainingComponent = () => {
  const [state, action] = useFormState(InsertTrainingType, {
    ok: false,
    error: '',
    data: null,
  })

  return (
    <form className="space-y-2 flex flex-col text-black" action={action}>
      <Link href="/workOut" className="flex items-center">
        <GoArrowLeft className="w-5 h-5" /> Voltar
      </Link>
      <InputComponent
        type="text"
        label="Titúlo"
        name="name"
        id="name"
        required={true}
      />
      <InputComponent
        type="text"
        label="Descrição"
        name="description"
        id="description"
        required={true}
      />
      <p className="text-xs text-red-600">{state && state.error}</p>
      <FormButton />
    </form>
  )
}
