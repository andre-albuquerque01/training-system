import { TrainingTypeInterface } from '@/actions/trainingType/showOneTraining'
import ShowTrainingType from '@/actions/trainingType/showTraining'
import Link from 'next/link'
import { GoArrowRight } from 'react-icons/go'

export default async function Dashboard() {
  const data = (await ShowTrainingType()) as TrainingTypeInterface[]

  return (
    <div className="mx-auto min-h-screen flex justify-center">
      <div className="p-4 space-y-4">
        {data.map((itens) => (
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
