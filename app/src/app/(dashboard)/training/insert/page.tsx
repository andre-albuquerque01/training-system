import { InsertTrainingComponent } from '@/components/training/insert'
import { Metadata } from 'next'

export const metadata: Metadata = {
  title: {
    template: '%s',
    default: 'Insert treino',
  },
}

export default function InsertTraining() {
  return (
    <div className="h-screen flex justify-center items-center ">
      <InsertTrainingComponent />
    </div>
  )
}
