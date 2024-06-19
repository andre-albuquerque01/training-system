import { UpdateTrainingComponent } from '@/components/training/update'
import { Metadata } from 'next'

export const metadata: Metadata = {
  title: {
    template: '%s',
    default: 'Alterar treino',
  },
}

export default function InsertTraining({ params }: { params: { id: string } }) {
  return (
    <div className="flex justify-center items-center mt-4">
      <UpdateTrainingComponent id={params.id} />
    </div>
  )
}
