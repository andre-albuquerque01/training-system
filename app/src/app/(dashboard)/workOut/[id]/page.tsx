import ShowOneWorkOut from '@/actions/workOut/showOneWorkOut'
import { WorkOutInterface } from '@/actions/workOut/showWorkOut'
import { GotBack } from '@/components/others/gotBack'
import Image from 'next/image'
import Link from 'next/link'
import { HiOutlinePencil } from 'react-icons/hi'

export default async function WorkOutOne({
  params,
}: {
  params: { id: string }
}) {
  const data = (await ShowOneWorkOut(params.id)) as WorkOutInterface

  return (
    <div className="px-4">
      <GotBack />
      <div className="flex flex-col items-center">
        <div>
          <div className="mt-5 space-y-1 max-w-80">
            {data.image && (
              <Image
                src={`${data.image}`}
                width={320}
                height={320}
                alt="Imagem"
                className="max-w-80 min-w-20 max-h-80 min-h-10 object-contain"
              />
            )}
            <p className="font-medium text-lg">{data.name}</p>
            <p className="text-lg text-justify">{data.description}</p>
            <p className="text-lg">Músculo: {data.muscle}</p>
            <p className="text-lg">Equipamento: {data.equipment}</p>
            <p className="text-lg">Dificuldade: {data.difficulty}</p>
            <p className="text-lg">Duração: {data.duration}</p>
            <p className="text-lg">Consumo de calorias: {data.calories}</p>
            <p className="text-lg">Peso: {data.weight}</p>
            <p className="text-lg">Repetição: {data.repetition}</p>
          </div>
        </div>
        <Link
          href={`/workOut/update/${data.idWorkOut}`}
          className="text-blue-500 mt-5 flex items-center gap-1"
        >
          <HiOutlinePencil className="w-5 h-5" /> Alterar item
        </Link>
      </div>
    </div>
  )
}
