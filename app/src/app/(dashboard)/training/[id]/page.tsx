import ShowOneTrainingType, {
  TrainingTypeInterface,
} from '@/actions/trainingType/showOneTraining'
import { TrainingInterface } from '@/actions/trainingType/showTraining'
import { DeleteTrainingComponente } from '@/components/training/delete'
import { DeleteTrainingWorkOutComponente } from '@/components/trainingWorkOut/delete'
import Image from 'next/image'
import Link from 'next/link'
import { CiCirclePlus } from 'react-icons/ci'
import { MdKeyboardArrowRight } from 'react-icons/md'

export default async function Training({ params }: { params: { id: string } }) {
  const data = (await ShowOneTrainingType(params.id)) as TrainingTypeInterface

  return (
    <div className="p-4">
      <div className="flex flex-col gap-3">
        <div className="inline-block">
          <Link
            href={`/trainingWorkOut/insert/${params.id}`}
            className="flex items-center gap-1 hover:text-blue-500"
          >
            <CiCirclePlus className="w-5 h-5" />
            Adicionar itens
          </Link>
        </div>
        <div className="inline-block">
          <DeleteTrainingComponente id={params.id} />
        </div>
      </div>
      <h1 className="font-bold text-xl">{data.name}</h1>
      <p>{data.description}</p>
      <div className="flex items-center flex-wrap gap-4">
        {data.training?.map((item: TrainingInterface) => (
          <div
            key={item.idTrainingWorkOut}
            className="border border-zinc-500 rounded-sm max-md:w-80 w-96  transform duration-500 hover:scale-105 hover:bg-zinc-800 hover:text-white"
          >
            <div className="relative flex items-center justify-between p-2">
              <Image
                src={`${item.workOut.image}`}
                width={100}
                height={100}
                alt="Imagem"
                className="w-[50%] max-h-20 min-h-10 object-contain"
              />
              <div className="w-[50%]">
                <p className="font-medium">{item.workOut.name}</p>
                <p className="font-light">{item.workOut?.repetition}</p>
              </div>
              <Link href={`/workOut/${item.workOut.idWorkOut}`}>
                <MdKeyboardArrowRight className="w-5 h-8" />
              </Link>
              <DeleteTrainingWorkOutComponente id={item.workOut.idWorkOut} />
            </div>
          </div>
        ))}
      </div>
    </div>
  )
}
