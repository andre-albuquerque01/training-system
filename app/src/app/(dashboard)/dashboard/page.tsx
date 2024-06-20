import { TrainingTypeInterface } from '@/actions/trainingType/showOneTraining'
import ShowTrainingType from '@/actions/trainingType/showTraining'
import Link from 'next/link'
import { CiCirclePlus } from 'react-icons/ci'
import { GoArrowRight } from 'react-icons/go'

export default async function Dashboard() {
  const data = (await ShowTrainingType()) as TrainingTypeInterface[]

  return (
    <div className="p-4">
      <div className=" inline-block">
        <Link
          href="/training/insert"
          className="flex items-center gap-1 hover:text-blue-500"
        >
          <CiCirclePlus className="w-5 h-5" />
          Adicionar itens
        </Link>
      </div>
      <h1 className="font-bold py-2 text-lg">Meu treino</h1>
      <div className="flex w-full items-center flex-wrap gap-2">
        {data &&
          data.length > 0 &&
          data.map((itens) => (
            <Link
              href={`/training/${itens.id}`}
              key={itens.id}
              className="border border-zinc-500 rounded-sm max-md:w-80 w-96 p-2 flex items-center justify-between transform duration-500 hover:scale-105 hover:bg-zinc-800 hover:text-white"
            >
              <div>{itens.name}</div>
              <GoArrowRight className="w-5 h-5" />
            </Link>
          ))}
      </div>
    </div>
  )
}
