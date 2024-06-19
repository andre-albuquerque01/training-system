import { PerfilUserComponent } from '@/components/user/perfil/perfil'
import { Metadata } from 'next'

export const metadata: Metadata = {
  title: {
    template: '%s',
    default: 'Insert user',
  },
}

export default function PerfilUser() {
  return (
    <div className="flex justify-center items-center mt-4">
      <PerfilUserComponent />
    </div>
  )
}
