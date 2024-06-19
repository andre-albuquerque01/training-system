import { InsertWorkOutComponent } from '@/components/workOut/insert'
import { Metadata } from 'next'

export const metadata: Metadata = {
  title: {
    template: '%s',
    default: 'Insert workOut',
  },
}

export default function InsertWorkOut() {
  return (
    <div className="flex justify-center items-center mt-4">
      <InsertWorkOutComponent />
    </div>
  )
}
