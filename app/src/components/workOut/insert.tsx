'use client'
import Link from 'next/link'
import { useFormState, useFormStatus } from 'react-dom'
import { GoArrowLeft } from 'react-icons/go'
import { InputComponent } from '@/components/form/inputComponent'
import { InsertWorkOut } from '@/actions/workOut/insert'

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

export const InsertWorkOutComponent = () => {
  const [state, action] = useFormState(InsertWorkOut, {
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
        label="Título"
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
      <InputComponent
        type="text"
        label="Músculo"
        name="muscle"
        id="muscle"
        required={false}
      />
      <InputComponent
        type="text"
        label="Equipamento"
        name="equipment"
        id="equipment"
        required={false}
      />
      <InputComponent
        type="text"
        label="Dificuldade"
        name="difficulty"
        id="difficulty"
        required={false}
      />
      <InputComponent
        type="text"
        label="Duração"
        name="duration"
        id="duration"
        required={false}
      />
      <InputComponent
        type="text"
        label="Consumo de calorias"
        name="calories"
        id="calories"
        required={false}
      />
      <InputComponent
        type="text"
        label="Peso para iniciar"
        name="weight"
        id="weight"
        required={false}
      />
      <InputComponent
        type="text"
        label="Quantidade de repetições"
        name="repetition"
        id="repetition"
        required={true}
      />
      <InputComponent
        type="text"
        label="Link da imagem"
        name="image"
        id="image"
        required={true}
      />
      <p className="text-xs text-red-600">{state && state.error}</p>
      <FormButton />
    </form>
  )
}
