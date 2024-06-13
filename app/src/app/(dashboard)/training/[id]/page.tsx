import ShowOneTrainingType, {
  TrainingTypeInterface,
} from '@/actions/trainingType/showOneTraining'
import { TrainingInterface } from '@/actions/trainingType/showTraining'

export default async function Training({ params }: { params: { id: string } }) {
  const data = (await ShowOneTrainingType(params.id)) as TrainingTypeInterface
  console.log(data)

  return (
    <div>
      <h1 className="font-bold">{data.name}</h1>
      <p>{data.description}</p>
      <div>
        {data.training?.map((item: TrainingInterface) => (
          <div
            key={item.idTrainingWorkOut}
            className="border border-zinc-500 rounded-sm max-md:w-80 w-96 p-2 flex items-center justify-between transform duration-500 hover:scale-105 hover:bg-zinc-800 hover:text-white"
          >
            <p className="font-medium">{item.workOut.name}</p>
            <p className="font-light">{item.workOut?.repetition}</p>
          </div>
        ))}
      </div>
    </div>
  )
}
