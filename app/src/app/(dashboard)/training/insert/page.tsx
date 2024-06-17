import { InsertTrainingComponent } from '@/components/training/insert'
import { Metadata } from 'next'

export const metadata: Metadata = {
  title: {
    template: '%s',
    default: 'Insert workOut',
  },
}

export default function InsertTraining() {
  return (
    <div className="flex justify-center items-center mt-4">
      <InsertTrainingComponent />
    </div>
  )
}
